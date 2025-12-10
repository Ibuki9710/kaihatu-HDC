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
// 郵便番号から住所を自動入力
async function searchZipcode() {
    const zipcode = document.getElementById('zipcode').value.trim();
    if (!zipcode.match(/^\d{7}$/)) {
        alert("郵便番号は7桁の数字で入力してください");
        return;
    }

    try {
        // 日本郵便 郵便番号検索APIを利用
        const response = await fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${zipcode}`);
        const data = await response.json();

        if (data.status === 200 && data.results) {
            const result = data.results[0];
            const address = result.address1 + result.address2 + result.address3;
            document.getElementById('address').value = address;
        } else {
            alert("住所が見つかりません");
        }

    } catch (error) {
        alert("住所検索でエラーが発生しました");
        console.error(error);
    }
}

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