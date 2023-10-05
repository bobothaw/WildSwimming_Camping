const apiKey = '29b67fe65d8e306bc7ea8ebbebc54465';
const baseCurrency = 'USD'; 
const apiUrl = `https://api.apilayer.com/exchangerates_data/latest/${baseCurrency}?apikey=${apiKey}`;

fetch(apiUrl)
  .then(response => response.json())
  .then(data => {
    // Handle the JSON response with exchange rate data
    console.log(data);
  })
  .catch(error => {
    // Handle errors
    console.error(error);
  });