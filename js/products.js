
const parent = document.querySelector('.products')
// шаблон
const product = document.querySelector('.products__item')

for (let a=0; a < 1; a++ )
{
    // перебераем массив data
    for( let i=0; i <= (data.length-1); i++ )
    {
        // клонируем элемент со всем его содержимым
        let clone = product.cloneNode(true)
        clone.querySelector('.products__name').textContent = data[i].name
        // получить значение атрибута src у тега img
        // clone.querySelector('img').getAttribute('src')
        // установить значение атрибуту src
        clone.querySelector('img').setAttribute('src',data[i].url[0] )
        //установили цену для кнопки 
        clone.querySelector('.products__price').textContent = Math.ceil( data[i].price - ( data[i].price * data[i].sale/100 ) )
        // установить в атрибут data-id id нашего товара
        clone.querySelector('.products__price').setAttribute('data-id', data[i].id )
        // получаем список классов у элемента
        clone.classList.remove('d-none')
        //вставить элемент в конец родительского блока 
        parent.append(clone)
        //console.log( data[i] )

        Math.ceil(5.7) // 6 по правилам математики
        Math.round(5.4) // 6 в большую 
        Math.floor(5.6) // 5 в меньшую
    }

}

// навешиваем событие на родителя
parent.addEventListener('click',function(Event){
    // элемент по которому был клик
    let el = Event.target
    // получаем id товара 
    let id = el.getAttribute('data-id')
    //console.log(Event)
    //console.log(Event.target)
    //console.log(Event.target.className)
    // получить список классов у элемента
    //console.log(Event.target.classList.contains('products__price'))

    // проверяем что мы нажали на кнопку "купить"
    if ( el.classList.contains('products__price') )
    {
        //alert('добавили в корзину товар с id '+id)
        let basket = getStorage('basket') 

        if (basket == null){
            // создаем данные и кладем туда id товара и количество
            setStorage('basket',{
                [id]:1
            })
        }
        else
        {

            // проверяем наличие id в корзине
            // если товара нет то мы его добавим
            if ( basket[id] == undefined )
            {
                 basket[id] = 1 
            }
            else
            // если id уже был
            {
                // получили количество
                 let count = basket[id]
                // инкрементировали
                 basket[id] = count+1
            }
            // сохранили данные
            setStorage('basket',basket)
        }  
    }
})



