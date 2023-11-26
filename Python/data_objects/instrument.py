'''
Bojan Seirovski
bojan.seirovski@exodusorbitals.com
Exodus Orbitals
'''

class Instrument:
    def __init__(self, d, f, fov, id, pixel, sensor, type):
        self.d = d
        self.f = f
        self.fov = fov
        self.id = id
        self.pixel = pixel
        self.sensor = sensor
        self.type = type
