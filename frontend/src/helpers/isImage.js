function isImage(filename){
  let validImage = ['png', 'jpg', 'jpeg', 'gif', 'bmp']

  let nameSplit = filename.split(".")

  return validImage.includes(nameSplit[nameSplit.length - 1])
  
}

export default isImage