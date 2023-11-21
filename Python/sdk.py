import requests

class exodusSdk:
    def __init__(self, base_url: str, username: str, api_key: str):
        self.username = username
        self.base_url = base_url
        self.api_key = api_key

    def get_satellites(self):
        response = requests.get(f"{self.base_url}/satellites")
        return response.json()

    def get_instruments(self, norad_id):
        data = {"norad_id": norad_id}
        response = requests.get(f"{self.base_url}/instruments", params=data)
        return response.json()

    def get_times_on_target(self, norad_id, instrument_id, lng, lat, nlt, net):
        data = {
            "norad_id": norad_id,
            "instrument_id": instrument_id,
            "lat": lat,
            "lng": lng,
            "nlt": nlt,
            "net": net,
        }
        response = requests.get(f"{self.base_url}/times_on_target", params=data)
        return response.json()

    def create_mission(
        self, norad_id, instrument_id, lng, lat, nlt, net, description, mission_type
    ):
        data = {
            "user": self.username,
            "api_key": self.api_key,
            "norad_id": norad_id,
            "instrument_id": instrument_id,
            "lat": lat,
            "lng": lng,
            "nlt": nlt,
            "net": net,
        }
        response = requests.post(f"{self.base_url}/create_mission", json=data)
        return response.json()

    def get_download(self, data_key):
        data = {"user": self.username, "api_key": self.api_key, "data_key": data_key}
        response = requests.get(f"{self.base_url}/data_download", params=data)
        return response.json()
