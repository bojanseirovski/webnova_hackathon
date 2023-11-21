import { api } from "./configs/axiosConfigs"
import { defineCancelApiObject } from "./configs/utils"

export const ExodusAPI = {
    getSatellites: async function (cancel = false) {
        const response = await api.request({
            url: '/satellites',
            method: "GET",
            signal: cancel ? cancelApiObject[this.get.name].handleRequestCancellation().signal : undefined,
        })
        return response.data;
    },
    getSatellites: async function (noradId, cancel = false) {
        const response = await api.request({
            url: '/instruments',
            method: "GET",
            params:{
                norad_id: noradId,
            },
            signal: cancel ? cancelApiObject[this.get.name].handleRequestCancellation().signal : undefined,
        })
        return response.data;
    },
    getTimesOnTarget: async function (noradId, instrumentId, lng, lat, nlt, net, cancel = false) {
        const response = await api.request({
            url: '/instruments',
            method: "GET",
            params:{
                norad_id: noradId,
                instrument_id: instrumentId,
                lng:lng,
                lat:lat,
                nlt:nlt,
                net:net
            },
            signal: cancel ? cancelApiObject[this.get.name].handleRequestCancellation().signal : undefined,
        })
        return response.data;
    },
    createMission: async function (username, apiKey, noradId, instrumentId, lng, lat, nlt, net, cancel = false) {
        const response = await api.request({
            url: '/create_mission',
            method: "POST",
            data:{
                user:username,
                api_key:apiKey,
                norad_id: noradId,
                instrument_id: instrumentId,
                lng:lng,
                lat:lat,
                nlt:nlt,
                net:net
            },
            signal: cancel ? cancelApiObject[this.create.name].handleRequestCancellation().signal : undefined,
        });
        return response.data;
    },
    getDataDownload: async function (username, apiKey, dataKey, cancel = false) {
        const response = await api.request({
            url: '/data_download',
            method: "GET",
            params:{
                user: username,
                api_key: apiKey,
                data_key: dataKey,
            },
            signal: cancel ? cancelApiObject[this.get.name].handleRequestCancellation().signal : undefined,
        })
        return response.data;
    }
}

const cancelApiObject = defineCancelApiObject(ExodusAPI);