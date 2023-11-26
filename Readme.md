# Exodus Orbital SDK toolkit

## Intro
This repository contains the SDK to allow easier interaction with Exodus Orbitals's API. For more details about the API, refer to the **swagger file**.

## Valid flow
The following is a valid flow to create a mission:
- get all available satellites - the response is a list of satellites
- from that list, pick a satellite, and use the ```norad_id``` to get all instruments - the response is a list of instruments for the satellite
- knowing the ```norad_id``` and the ```instrument.id```, get all times when that satellite is over a target (lat, lng) in a time range - the response is a list of timestamps/dates
- from that response, use the dates to create a mission - the response contains a data_key and date when the data will be available
- using the data key, get the data URL, this will allow you to download the data

## Usage
Use any of the SDKs as you wish, include them in your project accordingly.
In order to create the SKD object you will need:
- base_url
- API key
- username

These can be obtained from Exodus Orbitals

## Supported languages
So far, there is only support for Python, PHP and JavaScript/TypeScript(ideally React.js). 

## TODO
In the future expect separate repos for each SDK (React, Python, PHP...)

Exodus Orbitals
https://exodusorbitals.com
