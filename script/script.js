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

//住所（県）のセレクトボックスの作成
const prefecture = document.getElementById('prefecture');
if(prefecture){
    const value = [
    "北海道", "青森県", "岩手県", "秋田県", "山形県",
    "宮城県", "福島県", "群馬県", "栃木県", "千葉県",
    "埼玉県","東京都", "神奈川","長野県", "山梨県",
    "石川県", "岐阜県", "静岡県","福井県",  "新潟県",
     "愛知県", "富山県", "滋賀県", "奈良県","三重県",
     "大阪府", "京都府", "奈良県", "和歌山県","岡山県",
    "兵庫県", "広島県", "島根県", "鳥取県", "山口県",
    "香川県", "徳島県", "愛媛県", "高知県", "福岡県",
    "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県",
    "鹿児島県", "沖縄県"
];
    value.forEach(element => {
        const option = document.createElement('option');
        option.value=element;
        option.textContent=element;
        prefecture.appendChild(option);
    });     
}

// APIを呼び出し、郵便番号に基づく住所を取得
document.addEventListener('DOMContentLoaded', () => {
    const zipcodeInput = document.getElementById('zipcode');
    const searchButton = document.getElementById('searchButton');
    
    const prefectureInput = document.getElementById('prefecture');
    const cityInput = document.getElementById('city');
    const townInput = document.getElementById('town');

    function clearAddressFields() {
        if (prefectureInput) prefectureInput.value = '';
        if (cityInput) cityInput.value = '';
        if (townInput) townInput.value = '';
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
                    prefectureInput.value = data.data.pref; // 都道府県
                    cityInput.value = data.data.city; // 市区町村
                    townInput.value = data.data.town;// 町域
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