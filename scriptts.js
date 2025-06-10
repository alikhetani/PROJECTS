let p=fetch("http://localhost/PHPAPI/read.php")
p.then((value1) =>{
    return value1.json()
}).then((value2)=>{
    console.log(value2)
})