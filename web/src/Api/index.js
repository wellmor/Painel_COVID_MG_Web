import Axios from "axios";

// Old API: https://coronavirus-tracker-api.herokuapp.com/all https://coronavirus-tracker-api.herokuapp.com/v2
const baseUrl = '';

const api = {
    getAllLocation: () => Axios.get(`${baseUrl}/locations`),
    getLocation: (id) => Axios.get(`${baseUrl}/locations/${id}`)
}

export default api;