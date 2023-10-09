const apiUrl = `https://api.geoapify.com/v1/ipinfo?&apiKey=0332855da9434cac949b3875da093f68`;
var countryName;
var totalPrice;
var currencyCode;
let countryToCurrencyCode;

fetch('countryToCurrencyCode.json')
  .then(response => response.json())
  .then(data => {
    countryToCurrencyCode = data;

    return fetch(apiUrl);
  })
  .then(response => response.json())
  .then(data => data.country.names.en)
  .then(country => {
    const countryName = country;
    console.log(countryName);

    currencyCode = countryToCurrencyCode[countryName];
    console.log(currencyCode || "Country not found");
    return fetch('campsiteDetail.php');
})
.then(response => {
  if (!response.ok) {
    throw new Error('Network response was not ok');
  }

  return response.text();
})
.then(htmlContent => {
  const parser = new DOMParser();
  const doc = parser.parseFromString(htmlContent, 'text/html');

  const totalPriceElement = doc.querySelector('#TotalPrice');
  if (totalPriceElement) {
    totalPrice = totalPriceElement.textContent;
    console.log(totalPrice);
  } else {
    console.log('Total Price not found in HTML.');
  }
  return fetch ('https://v6.exchangerate-api.com/v6/00bc196a64445b9d2e24a37c/latest/USD');

})
.then(response => {
  if (!response.ok) {
    throw new Error('Network response was not ok');
  }
  return response.json();
})
.then(data => {
  const wantedValue = data.conversion_rates[currencyCode];
  console.log (wantedValue);
  const finalValue = wantedValue * totalPrice;
  parsedValue = parseFloat(finalValue).toFixed(2);
  console.log (parsedValue);
  formattedValue = new Intl.NumberFormat('en-US', { style: 'currency', currency: currencyCode }).format(finalValue);
  console.log (formattedValue);
  const totalPriceSpan = document.getElementById('TotalPrice');
  totalPriceSpan.textContent = formattedValue;
})
.catch(error => {
  console.log('Error:', error);
});


