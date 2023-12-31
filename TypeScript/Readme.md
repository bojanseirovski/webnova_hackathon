# Exodus Orbital JS/TypeScrips SDK for the satellite API

## Using the API
The API allows you to request satellite data by requesting a specific sensor/device. The goal is to **create a satellite mission** every time a sensor is to be used. 
When a mission is successful, the data can be downloaded via the ```/data_download``` API endpoint.
In order to create a mission you need to: 
1. select a satellite from a list of available satellites
2. select a sensor/device that is going to be used for the mission from a list of available devices on the selected satellite
3. select the date range when you want the mission to be executed
4. create the mission
5. get the data when the mission ends successfully. The data will be available only if the mission ends successfully.

Below is the valid API flow.

## Valid flow
The following is a valid flow to create a mission:
- get all available satellites - the response is a list of satellites, use the ```/satellites``` API endpoint
- from that list, pick a satellite, ```norad_id``` is the satellite ID
- use the ```norad_id``` to get all instruments via the ```/instruments``` API endpoint - the response is a list of instruments for the satellite
- knowing the ```norad_id``` and the ```instrument.id``` (from the ```/instruments``` endpoint ), get all times when that satellite is over a target (lat, lng) in a time range via the ```/times_on_target``` API endpoint - the response is a list of timestamps/dates
- from that response, use the dates to create a mission, use the ```/create_mission``` endpoint - the response contains a data_key and date when the data will be available
- using the data key, get the data URL via the ```/data_download``` API endpoint, this will allow you to download the data if the mission finished successfully
- the mission data is hosted on a AWS S3


## Setup
Use any of the SDKs as you wish, include them in your project accordingly.
In order to create the SKD object you will need:
- base_url
- API key
- username
These can be found and set in the config file ```apis/configs/axiosConfig.json```

## Demo Application
Please refer to https://github.com/bojanseirovski/webnova_hackathon_demo, it's a sample application that uses the React.js SDK