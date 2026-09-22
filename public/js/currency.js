document.addEventListener('DOMContentLoaded', function() {
    const sendCurrencies = document.querySelectorAll('.send-list .currency');
    const receiveCurrencies = document.querySelectorAll('.receive-list .currency');
    const sendImg = document.querySelector('.send-img');
    const sendText = document.querySelector('.send-text');
    const receiveImg = document.querySelector('.receive-img');
    const receiveText = document.querySelector('.receive-text');

    const paymentSendImg = document.getElementById('send-img');
    const paymentSendName = document.getElementById('send-currency-name');
    const paymentSendSymbol = document.getElementById('send-currency-symbol');

    const paymentReceiveImg = document.getElementById('receive-img');
    const paymentReceiveName = document.getElementById('receive-currency-name');
    const paymentReceiveSymbol = document.getElementById('receive-currency-symbol');

    const exchangeRateElement = document.querySelector('.exchange-rate p');

    // API URL for fetching exchange rates
    //const API_URL = 'https://min-api.cryptocompare.com/data/price';

    // Supported currencies
    const supportedCurrencies = {
        BTC: 'Bitcoin',
        ETH: 'Ethereum',
        PAYPAL: 'PayPal',
        ATOM: 'Cosmos',
        DOGE: 'Dogecoin',
        XRP: 'XRP',
        USDT: 'Tether',
        VISA: 'Visa/MasterCard'
    };

    // Function to fetch exchange rates for all supported currencies
    async function fetchExchangeRates() {
        const baseCurrency = 'USD'; // Fetch rates relative to USD
        const symbols = Object.keys(supportedCurrencies).join(',');

        try {
            const response = await fetch(`${API_URL}?fsym=${baseCurrency}&tsyms=${symbols}`);
            const data = await response.json();

            if (data) {
                let ratesText = '';
                for (const [symbol, rate] of Object.entries(data)) {
                    ratesText += `${supportedCurrencies[symbol]}: 1 ${baseCurrency} = ${rate} ${symbol}\n`;
                }
                exchangeRateElement.textContent = ratesText.trim();
            } else {
                exchangeRateElement.textContent = 'Exchange rates unavailable';
            }
        } catch (error) {
            console.error('Error fetching exchange rates:', error);
            exchangeRateElement.textContent = '1 BTC = 14.09 ETH';
        }
    }

    // Function to update selected currency
    function updateCurrency(selectedCurrency, list, img, text) {
        // Remove selection from all currencies in the list
        list.forEach(currency => currency.classList.remove('selected'));
        // Add selection to the clicked currency
        selectedCurrency.classList.add('selected');

        // Update image and text
        const currencySymbol = selectedCurrency.dataset.currency;
        const currencyImage = selectedCurrency.dataset.image;
        const currencyName = selectedCurrency.querySelector('span').textContent;

        img.src = currencyImage;
        text.textContent = currencySymbol;

        // Update payment data block
        if (list === sendCurrencies) {
            paymentSendImg.src = currencyImage;
            paymentSendName.textContent = currencyName;
            paymentSendSymbol.textContent = currencySymbol;
            disableCurrency(currencySymbol, receiveCurrencies);
        } else {
            paymentReceiveImg.src = currencyImage;
            paymentReceiveName.textContent = currencyName;
            paymentReceiveSymbol.textContent = currencySymbol;
            disableCurrency(currencySymbol, sendCurrencies);
        }

        // Fetch exchange rates
        fetchExchangeRates();
    }

    // Function to disable the selected currency in the opposite list
    function disableCurrency(currencySymbol, currencies) {
        currencies.forEach(currency => {
            if (currency.dataset.currency === currencySymbol) {
                currency.classList.add('disabled');
            } else {
                currency.classList.remove('disabled');
            }
        });
    }

    // Default selection: BTC for Send and ETH for Receive
    const defaultSendCurrency = document.querySelector('.send-list .currency[data-currency="BTC"]');
    const defaultReceiveCurrency = document.querySelector('.receive-list .currency[data-currency="ETH"]');

    if (defaultSendCurrency) {
        updateCurrency(defaultSendCurrency, sendCurrencies, sendImg, sendText);
    }
    if (defaultReceiveCurrency) {
        updateCurrency(defaultReceiveCurrency, receiveCurrencies, receiveImg, receiveText);
    }

    // Update currency selection for sending
    sendCurrencies.forEach(currency => {
        currency.addEventListener('click', function() {
            if (currency.classList.contains('disabled')) return;
            updateCurrency(currency, sendCurrencies, sendImg, sendText);
        });
    });

    // Update currency selection for receiving
    receiveCurrencies.forEach(currency => {
        currency.addEventListener('click', function() {
            if (currency.classList.contains('disabled')) return;
            updateCurrency(currency, receiveCurrencies, receiveImg, receiveText);
        });
    });

    // Refresh exchange rates every 30 seconds
    setInterval(() => {
        fetchExchangeRates();
    }, 30000);

    // Initial fetch of exchange rates
    fetchExchangeRates();
});
