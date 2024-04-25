import {useEffect} from "react";
import axios from "axios";
import Menu from "../components/Menu";

export default function LoginPage() {
    useEffect(() => {
        console.log('hihiih')
        axios.post('/api/login', {
            username: 'marcioal1991',
            password: '1234567890',
        })
            .then(console.log)
            .catch(console.log);

    }, []);
    return (
        <div>
            <Menu></Menu>
            <div>LoginPage</div>
        </div>
    );
}
