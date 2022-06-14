//constructor()
const fs = require('fs');
var Cataas = require('cataas-api')
var cataas = new Cataas()
var gif = {
    Gif: true,
    Size: 'md',
    Text: "hey dude",
    Filter: "none",
    TextSize: 35,
    TextColor: "LightBlue",
}
var resized = {
    Width: 300,
    Height: 200,
}
cataas.options = gif
cataas.options = resized

/*
var encodedUrl = cataas.encodeById('5a27feef2d0232008a63ef97')
cataas.download('images/Kitten.png')
    .then(successful => {
        if (successful) {
            console.log('Kitten is downloaded successfully')
        }
    })
    .catch(e => console.error(e))
*/

/*
//encode()

var encodedUrl = cataas.encode()
console.log(encodedUrl);
*/

/*
//encodeById(id)

var encodedUrl = cataas.encodeById('[ID]')
console.log(encodedUrl);
*/

/*
//async get()

cataas.encode()
cataas.get()
    .then(readable => {
        const stream = new fs.createWriteStream('images/cat.png')
        readable.pipe(stream)
    })
    .catch(e => console.error(e))
*/


//async download(path)

cataas.encode()
cataas.download('images/cat.png')
    .then(successful => {
        if (successful) {
            console.log('Downloaded file successfully')
        }
    })
    .catch(e => console.error(e))


/*
//async getAllTags()

cataas.encode()
cataas.getAllTags()
    .then(tags => {
        console.log(tags)
        //console.log('Tags length:', tags.length)
    })
    .catch(e => console.error(e))
*/


//async getCats(tags, options)
/*
cataas.encode()
cataas.getCats(['cute'])
    .then(cats => console.log('Results length:', cats.length))
    .catch(e => console.error(e))
*/

