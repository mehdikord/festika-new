class AppStorage{

    AppStorageSetItem(key,item){
        localStorage.setItem(key,item)
    }

}
export default AppStorage = new AppStorage();
