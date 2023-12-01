# Exodus Orbitals SDK toolkit

## Intro
This repository contains the SDK to allow easier interaction with Exodus Orbitals's API. For more details about the API, refer to the **swagger file**.

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
- use the ```norad_id``` to get all instruments via the ```/instruments``` API endpoint  - the response is a list of instruments for the satellite
- knowing the ```norad_id``` and the ```instrument.id``` (from the ```/instruments``` endpoint), get all times when that satellite is over a target (lat, lng) in a time range via the ```/times_on_target``` API endpoint - the response is a list of timestamps/dates
- from that response, use the dates to create a mission, use the ```/create_mission``` endpoint - the response contains a data_key and date when the data will be available
- using the data key, get the data URL via the ```/data_download``` API endpoint, this will allow you to download the data. The API returns a Zip archive URL, hosted on AWS S3. You need to download the Zip archive, extract and use any data within the file.

## Usage
Use any of the SDKs as you wish, and include them in your project accordingly.
In order to create the SKD object you will need:
- base_url
- API key
- username
- AWS S3 credentials

**These can be obtained from Exodus Orbitals.**

## Supported languages
So far, there is only support for Python, PHP, and JavaScript/TypeScript(ideally React.js). 


## For the curious - parameter description

- norad_id - https://en.wikipedia.org/wiki/Satellite_Catalog_Number
- tle1, tle2 - https://en.wikipedia.org/wiki/Two-line_element_set
- type - RGB for now, we are using a satellite camera
- nlt - Not Later Than, timestamp
- net - Not Earlier Than, timestamp
- lat - Latitude, float
- lon, lng - Longitude, float
- mission_type - **Hyperspectral(use this one)**, RGB Imager, Multispectral Imager...
- d - distance
- fov - Field Of View - https://www.sciencedirect.com/topics/earth-and-planetary-sciences/field-of-view
- pixel - Imager/camera pixels size
- sensor - sensor data, for an imager, maximum resolution
- type (instrument type) - see mission type, default value is **imager**



## TODO
In the future expect separate repos for each SDK (React, Python, PHP...)

Exodus Orbitals
https://exodusorbitals.com
