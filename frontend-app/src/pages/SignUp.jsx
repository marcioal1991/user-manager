import {useEffect} from "react";
import axios from "axios";
import Menu from "../components/Menu";

export default function SignUp() {
    useEffect(() => {
        axios.post('/api/signup/', {
            first_name: 'valeria',
            last_name: 'momo',
            email: 'valeria@momo.com',
            username: 'valeriamomo',
            password: '0987654321',
            confirm_password: '0987654321',
        })
            .then(console.log)
            .catch(console.log);

    }, []);

    return (
        <div>
            <Menu></Menu>
            <div>SignUp</div>
        </div>);
}
