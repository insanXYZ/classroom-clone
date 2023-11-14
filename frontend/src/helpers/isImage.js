function isImage(filename){
  let validImage = ['png', 'jpg', 'jpeg', 'gif', 'bmp']

  let nameSplit = filename.split("/")

  let extension = nameSplit[nameSplit.length - 1].split(".")

  return validImage.includes(extension[extension.length - 1])
  
}

export default isImage