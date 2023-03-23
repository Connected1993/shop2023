const addProduct = document.querySelector('input[type=submit]');
const dropZone = document.querySelector('.drag_zone');
const successExt = ['png','webp','svg','jpg','jpeg']
const maxFileSize = 1 * 1024 // kb
const previews = document.querySelector('.drag_preview')


addProduct.addEventListener('click',Event=>{
    Event.preventDefault()
    // product - id в теге form
    let data = new FormData(product)

    // посмотреть все поля обьекта data
    // data.entries() - возвращает массив

    // перебор обьектов 
    //console.log(Object.values({name:'Alex',city:'Moscow'}))
    //console.log(Object.keys({name:'Alex',city:'Moscow'}))
    //console.log(Object.entries({name:'Alex',city:'Moscow'}))

    // for of - перебираем массив
    for (let [k,v] of data.entries())
    {
        //console.log(k,v)
    }


    fetch('handler.php',{
        method:'POST',
        body:data
    })
    .then(response=> response.text())
   
})


dropZone.addEventListener('dragenter',Event=>{
    Event.preventDefault();
    console.log('dragenter')
})

dropZone.addEventListener('dragleave',Event=>{
    Event.preventDefault();
    console.log('dragleave')
})

dropZone.addEventListener('dragover',Event=>{
    Event.preventDefault();
    console.log('dragover')
})

dropZone.addEventListener('drop',Event=>{
    Event.preventDefault();
    
    // получили FileList и преобразовали его в Array
    // с помощью Array.from()
    let files = Array.from(Event.dataTransfer.files)
    let errorFiles = []
    // перебераем весь массив
    let successFiles = files.filter(file => {
        // получили расширение файла
        let getExt = file.name.split('.').at(-1)
        // проверяем, что допустимое расширение
        // и допустимый размер файла
        if ( successExt.includes(getExt) && (Math.round(file.size/1024)) <= maxFileSize ) return file 
        
        // файлы которые не будут загружены!
        errorFiles.push(file)
    });

    // перебераем валидные файлы
    successFiles.map(file=>{
        // генерируем ссылку на картинку
        let url = URL.createObjectURL(file)
        if (url)
        {
            previews.insertAdjacentHTML('afterbegin',`
                <div class="parent"> 
                    <img src="${url}" class="drag_preview_item">
                    <div class="close">X</div>
                </div>
            `)
        }    
    })


})