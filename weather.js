document.addEventListener("DOMContentLoaded", () => {
    const apiKey = '4b65d0d15a25424d888145132232809'; 
    // Construct the API URL for WeatherAPI.com
    var city = 'London';
    const apiUrl = `https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${city}`;

    // Fetch campsite city dynamically using AJAX
    fetch('getcity.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            city = data.city;
            const finalApiUrl = apiUrl.replace('London', city);
            // Fetch weather data from WeatherAPI.com
            console.log('Api URL: ', finalApiUrl);
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
            const wind_mph = data.current.wind_mph;
            const humidity = data.current.humidity;
            
            var iconElement = document.createElement("img");
            iconElement.src = data.current.condition.icon;
            iconElement.width = 50;
            iconElement.height = 50;

            // Create a weather message with the desired format
            const weatherMessage = `City: ${city} | Temperature: ${temperature}°C | Wind speed: ${wind_mph}mph | Humidity: ${humidity}% | Description: ${description}  |`;

            // Get the existing content of the marquee
            const weatherMarquee = document.getElementById('campsiteMarquee');
            const existingContent = weatherMarquee.textContent;

            // Append the new weather message to the existing content with a separator
            
            const separator = ' | '; // Adjust the separator as needed
            weatherMarquee.textContent = existingContent + separator + weatherMessage;
            weatherMarquee.appendChild(iconElement);
            
        })
        .catch(error => {
            console.error('Error fetching weather data:', error.message);
            const weatherMarquee = document.getElementById('campsiteMarquee');
            weatherMarquee.textContent = `Error: ${error.message}`;
        });
});
