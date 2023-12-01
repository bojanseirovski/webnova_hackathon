# Exodus Orbital Python SDK for the satellite API

## Please refer the ```example.py``` file.

## Valid flow
The following is a valid flow to create a mission:
- get all available satellites - the response is a list of satellites, use the ```/satellites``` API endpoint, or use the ```get_satellites()``` method
- from that list, pick a satellite, ```norad_id``` is the satellite ID
- use the ```norad_id``` to get all instruments via the ```/instruments``` API endpoint (```get_instruments()```) - the response is a list of instruments for the satellite
- knowing the ```norad_id``` and the ```instrument.id``` (from the ```/instruments``` endpoint ), get all times when that satellite is over a target (lat, lng) in a time range via the ```/times_on_target``` API endpoint or ```get_times_on_target()``` - the response is a list of timestamps/dates
- from that response, use the dates to create a mission, use the ```/create_mission``` endpoint or use ```create_mission()``` - the response contains a data_key and date when the data will be available
- using the data key, get the data URL via the ```/data_download``` API endpoint or ```get_download()```, this will allow you to get a download url for  the data if the mission finished successfully
- use the ```download_file()``` method or any other means to safely download data from AWS S3

## Response objects
The response objects are there for convenience, transforming the JSON to objects.