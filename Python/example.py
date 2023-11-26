from sdk import exodusSdk
from pprint import pprint

BASE_URL = ''
USER = ''
API_KEY = ''

lon = '-79.6'
lat = '43.7'
net = '2023-03-01 00:00:00'
nlt = '2023-03-04 00:00:00'
missionType = 'Hyperspectral'
missionDescription = 'Test Mission'

satApi = exodusSdk(BASE_URL, USER, API_KEY)

# get available satellites
satellites = satApi.get_satellites()
# get satellite norad_id
noradId = satellites[0].norad_id

# get available instruments for the satellite with norad_id
instruments = satApi.get_instruments(noradId)
# we are using imager, instrument.id = 1
instrumentId = instruments[0].id

# get times on target
timesOnTarget = satApi.get_times_on_target(noradId, instrumentId, lon, lat, net, nlt)

# create a mission, schedule data retrieval
mission = satApi.create_mission(
    noradId,
    instrumentId,
    lon, 
    lat, 
    net, 
    nlt, 
    missionDescription, 
    missionType
)
# the response from the above return data key and date when the data is available
dateAvailable = mission.date_available
satDataKey = mission.data_key

# get the data information
satDataInfo = satApi.get_download(satDataKey)

# download an archive with the mission data
dataUrl = satDataInfo.data_url
