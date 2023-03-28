
const parent = document.querySelector('.products')
// шаблон
const product = document.querySelector('.products__item')

// навешиваем событие на родителя
parent.addEventListener('click',function(Event){
    // элемент по которому был клик
    let el = Event.target
    // получаем id товара 
    let id = el.getAttribute('data-id')

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



