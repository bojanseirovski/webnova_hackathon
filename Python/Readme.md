# Exodus Orbital Python SDK for the satellite API

## Please refer the ```example.py``` file.

## Valid flow
The following is a valid flow to create a mission:
- get all available satellites - the response is a list of satellites
- from that list, pick a satellite, and use the ```norad_id``` to get all instruments - the response is a list of instruments for the satellite
- knowing the ```norad_id``` and the ```instrument.id```, get all times when that satellite is over a target (lat, lng) in a time range - the response is a list of timestamps/dates
- from that response, use the dates to create a mission - the response contains a data_key and date when the data will be available
- using the data key, get the data URL, this will allow you to download the data

## Response objects
The response objects are there for convenience, transforming the JSON to objects.