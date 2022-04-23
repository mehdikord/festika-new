import errors from "./Errors";

class Auth{

    AuthLoginUser(user,token){
        localStorage.setItem('auth_user',user)
        localStorage.setItem('auth_token',token)
    }

    AuthGetUser(){
        return JSON.parse(localStorage.getItem('auth_user'));
    }

    AuthGetToken(){
        return localStorage.getItem('auth_token')
    }

    AuthCheck(){
        return !!(this.AuthGetToken() && this.AuthGetUser());

    }
    AuthRefreshUserData(){
        axios.get('/api/panel/me').then(response=>{
            if (response.data){
                localStorage.setItem('auth_user',response.data);
            }
        })
    }
    AuthRefreshOnline(){
        axios.get('/api/panel/me').then(response=>{
            if (response.data){
                return true;
            }
            return false;
        }).catch(e=>{
            return false;
        })
    }
    AuthLogout(){
        localStorage.removeItem('auth_user');
        localStorage.removeItem('auth_token');
        window.open('/','_self');
    }

}
export default Auth = new Auth();
