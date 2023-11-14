function getNameData(filename){

  let nameSplit = filename.split("/")

  let data = nameSplit[nameSplit.length - 1]

  return data
  
}

export default getNameData