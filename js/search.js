const search = document.getElementById('search')
let timer = null
const delay = 250

// keypress - нажали и отпустили клавишу
search.addEventListener('keypress',searchSend)

search.addEventListener('keyup',(event)=>{
    // если нажали backSpace вызваем функцию
    if (event.keyCode == 8 ) searchSend()
})



function searchSend()
{

    // удаляем таймер если был!
    clearTimeout(timer)
    timer = setTimeout( ()=>{
        // если пусто тогда ничего не делаем!
        if (search.value.length == 0) 
        {
            document.querySelector('.search__result').innerHTML = ''
            return false
        } 

        fetch('handler.php',{
            method:'POST',
            headers:{
                'Content-type':'application/x-www-form-urlencoded;charset=utf-8'
            },
            body:'action=search&text='+search.value
        })
        .then(response=> response.text())
        .then(text=> document.querySelector('.search__result').innerHTML = text )

    },delay)
}