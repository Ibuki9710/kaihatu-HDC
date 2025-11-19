//生年月日のセレクトボックスの作成
const yearSelect = document.getElementById('barth-year');
if(yearSelect){
    for (let i=1940; i<=2025; i++){
        const option = document.createElement('option');
        option.value=i;
        option.textContent=i;
        yearSelect.appendChild(option);
        if(i==2000){
            option.selected=true;
        }
    }
}

const monthSelect = document.getElementById('barth-month');
if(monthSelect){
    for (let i=1; i<=12; i++){
        const option = document.createElement('option');
        option.value=i;
        option.textContent=i;
        monthSelect.appendChild(option);
    }
}

const daySelect = document.getElementById('barth-day');
if(daySelect){
    for (let i=1; i<=31; i++){
        const option = document.createElement('option');
        option.value=i;
        option.textContent=i;
        daySelect.appendChild(option);
    }
}

//メニュー開閉の設定
const menuToggle = document.getElementById("menu-toggle");
if(menuToggle){
    document.addEventListener('DOMContentLoaded', () => {
        // IDで要素を取得
        const sideMenu = document.getElementById('side-menu');
        // クリックイベントリスナーを設定
        menuToggle.addEventListener('click', () => {
            // メニューとボタンにCSSクラスをトグル
            sideMenu.classList.toggle('is-open');
            menuToggle.classList.toggle('is-active');

            // アクセシビリティ属性を更新
            const isExpanded = sideMenu.classList.contains('is-open');
            menuToggle.setAttribute('aria-expanded', isExpanded);
            });
    });
}

//セレクトのリンク設定
function navigateToUrl(selectElement) {
    const url = selectElement.value; 
    if (url) { 
        window.location.href = url;
    }
}

// APIを呼び出し、郵便番号に基づく住所を取得
document.addEventListener('DOMContentLoaded', () => {
    const zipcodeInput = document.getElementById('zipcode');
    const searchButton = document.getElementById('searchButton');
    const addressInput = document.getElementById('address');

    function clearAddressFields() {
        if (addressInput) addressInput.value = '';
    }

    if (zipcodeInput) {
        // Enterキーが押された場合
        zipcodeInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                fetchAddress();
            }
        });
    }

    // 検索ボタンがクリックされた場合
    if (searchButton) {
        searchButton.addEventListener('click', fetchAddress);
    }
    
    // 住所検索を実行する関数
    function fetchAddress() {
        const zipcodeValue = zipcodeInput.value.replace(/[^0-9]/g, '');

        if (zipcodeValue.length !== 7) { 
            alert('郵便番号は7桁で入力してください。');
            clearAddressFields(); // 桁数エラー時にもクリア
            return;
        }

        fetch(`https://api.zipaddress.net/?zipcode=${zipcodeValue}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTPエラー: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if(data.code === 200) {
                    addressInput.value = data.data.pref + data.data.city + data.data.town; 
                } else {
                    alert('住所を取得できませんでした。郵便番号を確認してください。');
                    clearAddressFields();
                }
            })
            .catch(error => {
                console.error('通信中にエラーが発生しました:', error);
                alert('住所の取得中にエラーが発生しました。コンソールを確認してください。');
                clearAddressFields();
            });
    }

});