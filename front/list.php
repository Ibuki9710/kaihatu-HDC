<input type="checkbox" id="menu-toggle-checkbox" class="menu-checkbox" hidden>
    
    <label for="menu-toggle-checkbox" class="menu-button">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </label>

<nav class="menu">
    <br>
    <p></p>
    <strong>並び替え</strong><br>
    <ul class="menu-ul">
        <li><a href="#" name="order" id="#" class="menu-hover">新着順</a></li>
        <li><a href="#" name="order" id="#" class="menu-hover">価格が高い順</a></li>
        <li><a href="#" name="order" id="#" class="menu-hover">価格が低い順</a></li>
        <li><a href="#" name="order" id="#" class="menu-hover">評価が高い順</a></li>
    </ul>
    <strong>サイズ</strong><br>
    <ul class="menu-ul">
        <form action="../back/item.php" method="post">
            <li>縦　<input tyep="text" name="heiht" size="3" min="0">cm</li>
            <li>横　<input type="text" name="width" size="3" min="0">cm</li>
            <button type="submit" class="menu-btn">検索</button>
        </form>
    </ul>
    <strong>品質</strong><br>
    <ul class="menu-ul">
        <li><label class="menu-hover"><input type="radio" name="quality" value="">良品</label></li>
        <li><label class="menu-hover"><input type="radio" name="quality" value="">並品</label></li>
        <li><label class="menu-hover"><input type="radio" name="quality" value="">雑あり</label></li>
    </ul>
</nav>