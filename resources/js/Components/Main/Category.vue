<template>
    <div class="list-items cart-wrapper">
        <div class="list-left ">
        <h1 class="cart-title">Количество очагов:</h1>
        <ul>
            <li class="block level active">
            <a href="/ru/dashboard-problems/index?levelName=all">
                <h3 class="outbreaks-title">Всего 62 проблемных вопроса</h3>
                <span> Очагов: 11 &nbsp; </span>
                <span class="outbreaks-count-block">
                <span class="red_text">1 </span>, <span class="yellow_text">2 </span>, <span class="orange_text">8 </span>, </span>
            </a>
            </li>
            <li class="block level ">
            <a href="/ru/dashboard-problems/index?levelName=republic">
                <h3 class="outbreaks-title">Республиканский уровень</h3>
                <span> Очагов: 4 &nbsp; </span>
                <span class="outbreaks-count-block">
                <span class="yellow_text">1 </span>, <span class="orange_text">3 </span>, </span>
            </a>
            </li>
            <li class="block level ">
            <a href="/ru/dashboard-problems/index?levelName=obl">
                <h3 class="outbreaks-title">Областной уровень</h3>
                <span> Очагов: 1 &nbsp; </span>
                <span class="outbreaks-count-block">
                <span class="red_text">1 </span>, </span>
            </a>
            </li>
            <li class="block level ">
            <a href="/ru/dashboard-problems/index?levelName=city">
                <h3 class="outbreaks-title">Городской уровень</h3>
                <span> Очагов: 6 &nbsp; </span>
                <span class="outbreaks-count-block">
                <span class="yellow_text">1 </span>, <span class="orange_text">5 </span>, </span>
            </a>
            </li>
        </ul>
        </div>
        <div class="list-right">
        <h1 class="cart-title">Проблемные вопросы:</h1>
        <ul>
            <li class="block problem-block ">
            <a href="/ru/dashboard-problems/index?levelName=1" class="d-flex-center">
                <div class="list-right-count"> 12 </div>
                <div class="problem-title">Системообразующие предприятия</div>
            </a>
            </li>
            <li class="block problem-block ">
            <a href="/ru/dashboard-problems/index?levelName=2" class="d-flex-center">
                <div class="list-right-count"> 1 </div>
                <div class="problem-title">Проблемные ЖК (дольщики)</div>
            </a>
            </li>
            <li class="block problem-block ">
            <a href="/ru/dashboard-problems/index?levelName=3" class="d-flex-center">
                <div class="list-right-count"> 25 </div>
                <div class="problem-title">Проблемы в сфере ЖКХ и автодорог</div>
            </a>
            </li>
            <li class="block problem-block ">
            <a href="/ru/dashboard-problems/index?levelName=4" class="d-flex-center">
                <div class="list-right-count"> 7 </div>
                <div class="problem-title"> Другие социальные проблемы </div>
            </a>
            </li>
            <li class="block problem-block ">
            <a href="/ru/dashboard-problems/index?levelName=5" class="d-flex-center">
                <div class="list-right-count"> 2 </div>
                <div class="problem-title">Экологические проблемы</div>
            </a>
            </li>
            <li class="block problem-block ">
            <a href="/ru/dashboard-problems/index?levelName=6" class="d-flex-center">
                <div class="list-right-count"> 4 </div>
                <div class="problem-title">Проблемы в сельскохозяйственном направлении</div>
            </a>
            </li>
        </ul>
        </div>
    </div>
</template>
    
<script>
export default{
    name : 'Category',
}
</script>