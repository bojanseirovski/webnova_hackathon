# Exodus Orbital JS/TypeScrips SDK for the satellite API

## Valid flow
The following is a valid flow to create a mission:
- get all available satellites - the response is a list of satellites, use the ```/satellites``` API endpoint
- from that list, pick a satellite, ```norad_id``` is the satellite ID
- use the ```norad_id``` to get all instruments via the ```/instruments``` API endpoint - the response is a list of instruments for the satellite
- knowing the ```norad_id``` and the ```instrument.id``` (from the ```/instruments``` endpoint ), get all times when that satellite is over a target (lat, lng) in a time range via the ```/times_on_target``` API endpoint - the response is a list of timestamps/dates
- from that response, use the dates to create a mission, use the ```/create_mission``` endpoint - the response contains a data_key and date when the data will be available
- using the data key, get the data URL via the ```/data_download``` API endpoint, this will allow you to download the data if the mission finished successfully
