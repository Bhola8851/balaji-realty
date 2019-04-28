
//Gate for GUI
export default class Gate{
    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'Admin';
    }
    isEmployee(){
        return this.user.type === 'Employee';
    }
    isAgent(){
        return this.user.type === 'Agent';
    }

    isSupplier(){
        return this.user.type === 'Supplier';
    }

    isManager(){
        return this.user.type === 'Manager';
    }


    isAdminOrEmployee(){
        if (this.user.type === 'Admin' || this.user.type === 'Employee') {

            return true;
        }
    }

    isAgentOrSupplier(){
        if (this.user.type === 'Agent' || this.user.type === 'Supplier') {

            return true;
        }

    }

    isAdminOrSupplier(){
        if (this.user.type === 'Admin' || this.user.type === 'Supplier') {

            return true;
        }

    }

    isBan(){
        if (this.user.status === 'Blocked') {

            return false;
        }
    }

}
