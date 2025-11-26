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

document.addEventListener('DOMContentLoaded', () => {
    // すべてのドロップゾーンとファイルインプットを取得
    const dropZones = document.querySelectorAll('.drop-zone');
    const fileInputs = document.querySelectorAll('.file-input');

    // 1. クリックによるファイル選択を有効にする
    fileInputs.forEach(input => {
        // ファイルが選択されたときの処理
        input.addEventListener('change', (event) => {
            const files = event.target.files;
            if (files.length > 0) {
                // 選択されたファイルを表示・処理する関数を呼び出す
                handleFiles(files, event.currentTarget.closest('.drop-zone').id);
            }
        });
    });

    // 2. ファイルのドラッグ＆ドロップを有効にする
    dropZones.forEach(zone => {
        // ドラッグされた要素がドロップゾーンに入ったとき
        zone.addEventListener('dragenter', (e) => {
            e.preventDefault();
            zone.classList.add('dragover-file');
        });

        // ドラッグされた要素がドロップゾーンの上にある間
        zone.addEventListener('dragover', (e) => {
            e.preventDefault(); // これがないとドロップが許可されない
        });

        // ドラッグされた要素がドロップゾーンから出たとき
        zone.addEventListener('dragleave', (e) => {
            zone.classList.remove('dragover-file');
        });

        // 要素がドロップされたとき
        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.classList.remove('dragover-file');

            // ドロップされたファイルを取得
            const files = e.dataTransfer.files;

            if (files.length > 0) {
                // 取得したファイルを、対応するファイルインプットに設定
                const fileInput = zone.querySelector('.file-input');
                fileInput.files = files; // filesプロパティにデータを設定

                // 選択されたファイルを表示・処理する関数を呼び出す
                handleFiles(files, zone.id);
            }
        });
    });

    // 3. ファイルを処理する関数（ここではファイル名を表示する例）
    function handleFiles(files, zoneId) {
        const zone = document.getElementById(zoneId);
        let output = `[${zoneId}] 選択されたファイル:\n`;

        // 複数のファイルがある場合を考慮
        for (let i = 0; i < files.length; i++) {
            output += ` - ${files[i].name} (${(files[i].size / 1024).toFixed(1)} KB)\n`;
        }

        // 結果をコンテナ内に表示する（例として、既存のテキストを上書き）
        const dropText = zone.querySelector('.drop-text');
        dropText.textContent = output;

        console.log(output);
        alert(output);
    }
});