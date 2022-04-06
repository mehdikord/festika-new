class Helper {
    HelperGetFileExtension(file){
        let explode = file.split('.');
        return explode[explode.length - 1]
    }

}

export default Helper = new Helper();
