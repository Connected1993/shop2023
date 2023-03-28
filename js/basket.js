const table = document.querySelector('.p-table')
const item = document.querySelector('.p-table .p-item')


// получаем сохраненные товары
function getStorage(key)
{
    return JSON.parse(localStorage.getItem(key))
    //return localStorage.getItem(key)
}

// сохраняем товар в корзине

function setStorage(key,data)
{
    localStorage.setItem(key,JSON.stringify(data))
    // вызываем отрисовку корзины
    renderTotalProducts()
}

// функия для перерисовки количества товаров в корзине
function renderTotalProducts()
{
    let count = 0
    // получили данные с хранилища
    let data = JSON.parse( localStorage.getItem('basket') )
    // если товаров нет, то ничего не делаем
    if (data == null) return

    for(let key in data)
    {
        //считаем кол товаров 
        count++
    }
    // textContent = 111 - установить значение между тегами
    // textContext - получить 
    // value = 111 - установить значение для input
    // value - установить значение для input
    document.querySelector('.menu__circle').textContent = count
}

// функия для отрисовки товаров в корзине
function renderItemProducts(product)
{
    // клонируем заглушку/шаблон
    let clone = item.cloneNode(true)
    // удаляем класс d-none
    clone.classList.remove('d-none')
    // находим картинку
    clone.querySelector('img').setAttribute('src',product.url[0])
    // установили центу 
    clone.querySelector('.p-price').textContent = product.price
    // описание товара
    clone.querySelector('details').textContent = product.name
    clone.querySelector('.p-body__default').textContent = product.name
    clone.querySelector('.p-box input').value = 1
    // вставляем clone в коцен родительского блока p-table
    //table.append(clone)
    
    table.insertAdjacentElement('afterbegin',clone)
}

// load - срабатывает когда весь контент загрузился
// DOMContentLoaded - срабатывает когда отрисовались теги ( лучше использовать ее)
// событие которое следит за загрузкой страницы
window.addEventListener('DOMContentLoaded',function(){
    renderTotalProducts()
})

// навешиваем событие на отслеживание изменения localStorage
window.addEventListener('storage',function(){
    console.log('update storage')

})

