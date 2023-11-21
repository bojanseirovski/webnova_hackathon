from sdk import exodusSdk
from pprint import pprint

BASE_URL = ''
USER = ''
API_KEY = ''
NORAD_ID = 1

satApi = exodusSdk(BASE_URL, USER, API_KEY)

pprint(satApi.get_satellites())
pprint(satApi.get_instruments(NORAD_ID))