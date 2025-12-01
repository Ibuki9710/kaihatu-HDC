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
    const dropZones = document.querySelectorAll('.drop-zone');
    const fileInputs = document.querySelectorAll('.file-input');

    // ファイル選択（changeイベント）処理
    fileInputs.forEach(input => {
        input.addEventListener('change', (event) => {
            const files = event.target.files;
            const dropZone = event.currentTarget.closest('.drop-zone');
            
            if (files.length > 0) {
                handleFiles(files, dropZone);
            }
        });
    });

    // ドロップゾーンのイベント処理
    dropZones.forEach(zone => {
        const fileInput = zone.querySelector('.file-input');
        
        // ドロップゾーン全体をクリックでファイル選択
        zone.addEventListener('click', (e) => {
            if (e.target.classList.contains('file-input')) {
                return;
            }
            fileInput.click();
        });

        

        // ドラッグイベント
        zone.addEventListener('dragenter', (e) => { e.preventDefault(); zone.classList.add('dragover-file'); });
        zone.addEventListener('dragover', (e) => { e.preventDefault(); });
        zone.addEventListener('dragleave', (e) => { zone.classList.remove('dragover-file'); });
        
        // ドロップイベント
        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.classList.remove('dragover-file');

            const files = e.dataTransfer.files;

            if (files.length > 0) {
                fileInput.files = files; 
                handleFiles(files, zone);
            }
        });
    });

    // ファイル処理（画像表示とファイル名保存）関数
    function handleFiles(files, dropZone) {
        const fileIcon = dropZone.querySelector('.file-icon');
        const existingImg = dropZone.querySelector('.uploaded-image-preview'); 
        
        if (fileIcon) fileIcon.style.display = 'none';
        if (existingImg) existingImg.remove();
        
        // 隠しフィールドの生成または取得
        let fileNameStorage = dropZone.querySelector('.file-name-storage');
        if (!fileNameStorage) {
            fileNameStorage = document.createElement('input');
            fileNameStorage.type = 'hidden';
            fileNameStorage.className = 'file-name-storage';
            fileNameStorage.name = `image_name_${dropZone.id}`;
            dropZone.appendChild(fileNameStorage);
        }
        
        fileNameStorage.value = '';
        
        const file = files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result; 
                img.alt = file.name;
                img.classList.add('uploaded-image-preview'); 
                
                dropZone.appendChild(img); 
                
                if (fileNameStorage) {
                    fileNameStorage.value = file.name;
                }
            };

            reader.readAsDataURL(file);
        } else if (file) {
             alert('選択されたファイルは画像ではありません。');
        }
        
        if (files.length === 0 && fileIcon) {
            fileIcon.style.display = ''; 
        }
    }
});