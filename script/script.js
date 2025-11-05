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
document.addEventListener('DOMContentLoaded', () => {
    // IDで要素を取得
    const menuToggle = document.getElementById('menu-toggle');
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