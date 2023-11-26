'''
Bojan Seirovski
bojan.seirovski@exodusorbitals.com
Exodus Orbitals
'''

class DataDownload:
    def __init__(self, data_url, logs_url, status):
        self.data_url = data_url
        self.status = status
        self.logs_url = logs_url

    def getDataUrl(self):
        return self.data_url

    def getStatus(self):
        return self.status