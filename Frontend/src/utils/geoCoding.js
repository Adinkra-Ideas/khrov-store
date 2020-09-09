const BASE_GEOCODING_URL = 'https://api.bigdatacloud.net/data/reverse-geocode-client';

const getCoordinates = async () => {
  return new Promise((resolve, reject) => {
    navigator.geolocation.getCurrentPosition(resolve, reject);
  });
};

const fetchLocationData = async (latitude, longitude) => {
  try {
    const res = await fetch(`${BASE_GEOCODING_URL}?latitude=${latitude}&longitude=${longitude}&localityLanguage=en`);

    if (!res.ok) throw new Error('Unable to fetch location data');

    return await res.json();
  } catch (error) {
    console.log('fetchLocationData:', error);
  }
};

export const getLocationData = async () => {
  try {
    const data = await getCoordinates();
    if (data) {
      return await fetchLocationData(data.latitude, data.longitude);
    }
  } catch (error) {
    console.log('getLocationData:', error);
  }
};
