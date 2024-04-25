import {useEffect, useState} from "react";
import axios from "axios";
import ContentWrapper from "../components/ContentWrapper";
import UsersTableList from "../components/UsersTableList";
import {Skeleton} from "@mui/material";
import UserHeaderList from "../components/UserHeaderList";
import UserFooterList from "../components/UserFooterList";

export default function UsersList()
{
    const [loading, setLoading] = useState(true);
    const [users, setUsers] = useState([]);
    useEffect(() => {
        axios.get('/api/users/')
            .then((response) => {
                setUsers(response.data.data);
                setLoading(false)
            })
            .catch(console.log);
    }, []);

    return (
        <ContentWrapper
            menuName={"User management"}
            menuDescription={"Add, edit, and view the list of your platform users."}
        >
            <UserHeaderList />
            {
                !loading ?
                (
                    <UsersTableList userList={users} />
                ) :
                    (
                        <>
                            <Skeleton variant="rectangular" width="100%" height={20} sx={{ marginBottom: '10px' }} />
                            <Skeleton variant="rectangular" width="100%" height={20} sx={{ marginBottom: '10px' }} />
                            <Skeleton variant="rectangular" width="100%" height={20} sx={{ marginBottom: '10px' }} />
                            <Skeleton variant="rectangular" width="100%" height={20} />
                        </>
                    )
            }
            <UserFooterList />
        </ContentWrapper>
    );
}
