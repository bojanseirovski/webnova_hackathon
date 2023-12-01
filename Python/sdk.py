import requests
import boto3
from data_objects.satellite import Satellite
from data_objects.instrument import Instrument
from data_objects.mission import Mission
from data_objects.times_on_target import TimesOnTarget
from data_objects.data_download import DataDownload

'''
SDK for the satellite API
Bojan Seirovski
bojan.seirovski@exodusorbitals.com
Exodus Orbitals
'''
class exodusSdk:
    def __init__(self, base_url: str, username: str, api_key: str):
        self.username = username
        self.base_url = base_url
        self.api_key = api_key

    def get_satellites(self):
        response = requests.get(f"{self.base_url}/satellites")
        jsonSatellites = response.json()
        return self.__get_satellites(jsonSatellites)

    def get_instruments(self, norad_id):
        data = {"norad_id": norad_id}
        response = requests.get(f"{self.base_url}/instruments", params=data)
        jsonInstruments = response.json()
        return self.__get_instruments(jsonInstruments)

    def get_times_on_target(self, norad_id, instrument_id, lng, lat, net, nlt):
        data = {
            "norad_id": norad_id,
            "instrument_id": instrument_id,
            "lat": lat,
            "lng": lng,
            "nlt": nlt,
            "net": net,
        }
        response = requests.get(f"{self.base_url}/times_on_target", params=data)
        jsonTimes = response.json()
        return self.__get_time_on_target(jsonTimes)

    def create_mission(
        self, norad_id, instrument_id, lng, lat, net, nlt, description, mission_type
    ):
        data = {
            "user": self.username,
            "api_key": self.api_key,
            "norad_id": norad_id,
            "instrument_id": instrument_id,
            "lat": lat,
            "lon": lng,
            "net": net,
            "nlt": nlt,
            "description": description,
            "mission_type": mission_type,
        }
        response = requests.post(f"{self.base_url}/create_mission", json=data)
        jsonMission = response.json()
        return self.__get_mission(jsonMission)

    def get_download(self, data_key):
        data = {"user": self.username, "api_key": self.api_key, "data_key": data_key}
        response = requests.get(f"{self.base_url}/data_download", params=data)
        jsonData = response.json()
        return self.__get_download(jsonData)

    def download_file(self, filename, access_key, secret_key, bucket, save_to_file_name):
        s3 = boto3.client('s3', aws_access_key_id=access_key, aws_secret_access_key=secret_key)
        s3.download_file(bucket, filename, save_to_file_name)

    # private methods, helpers
    def __get_satellites(self, response):
        all_satellites = []
        for i in response:
            sat = Satellite(i['description'], i['name'], i['norad_id'],i['tle1'],i['tle2'],i['type'])
            all_satellites.append(sat)
        return all_satellites

    def __get_instruments(self, response):
        all_instruments = []
        for i in response[0]['instruments']:
            instrument = Instrument(i['d'], i['f'], i['fov'],i['id'],i['pixel'], i['sensor'],i['type'])
            all_instruments.append(instrument)
        return all_instruments

    def __get_time_on_target(self, response):
        all_times = []
        for i in response['target_passes']:
            times = TimesOnTarget(i[0], i[1])
            all_times.append(times)
        return all_times

    def __get_mission(self, response):
        mission = Mission(response['data_key'], response['date_available'],response['status'])
        return mission

    def __get_download(self, response):
        data_download = DataDownload(response['data_url'], response['logs_url'],response['status'])
        return data_download
