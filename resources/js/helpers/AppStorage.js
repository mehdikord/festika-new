class AppStorage{

    AppStorageSetItem(key,item){
        localStorage.setItem(key,item)
    }

    AppStorageGetItem(key){
      return localStorage.getItem(key);
    }

}
export default AppStorage = new AppStorage();
