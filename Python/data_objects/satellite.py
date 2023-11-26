'''
Bojan Seirovski
bojan.seirovski@exodusorbitals.com
Exodus Orbitals
'''
class Satellite:
    def __init__(self, description, name, norad_id, tle1, tle2, type):
        self.description = description
        self.name = name
        self.norad_id = norad_id
        self.tle1 = tle1
        self.tle2 = tle2
        self.type = type
