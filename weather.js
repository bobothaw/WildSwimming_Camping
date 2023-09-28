document.addEventListener("DOMContentLoaded", () => {
    // Construct the API URL for WeatherAPI.com
    const apiUrl = `https://api.weatherapi.com/v1/current.json?key=YOUR_API_KEY&q=`;

    // Fetch campsite city dynamically using AJAX
    fetch('get_city.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const city = data.city;

            // Construct the final API URL with the dynamically retrieved city
            const finalApiUrl = apiUrl + city;

            // Fetch weather data from WeatherAPI.com
            return fetch(finalApiUrl);
        })
        .then(response => response.json())
        .then(data => {
            // Check if the API returned an error message
            if (data.error) {
                throw new Error(data.error.message);
            }

            // Extract relevant weather information
            const temperature = data.current.temp_c;
            const description = data.current.condition.text;

            // Display the weather information on the page
            const weatherInfo = document.getElementById('weather-info');
            weatherInfo.innerHTML = `
                <p>City: ${city}</p>
                <p>Temperature: ${temperature}°C</p>
                <p>Description: ${description}</p>
            `;
        })
        .catch(error => {
            console.error('Error fetching weather data:', error.message);
            const weatherInfo = document.getElementById('weather-info');
            weatherInfo.innerHTML = `<p>Error: ${error.message}</p>`;
        });
});
