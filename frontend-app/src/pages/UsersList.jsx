import {useEffect, useState} from "react";
import axios from "axios";
import ContentWrapper from "../components/ContentWrapper";
import UsersTableList from "../components/Utils/UsersTableList";
import {Skeleton} from "@mui/material";
import UserHeaderList from "../components/Utils/UserHeaderList";
import UserFooterList from "../components/Utils/UserFooterList";

export default function UsersList()
{
    const [loading, setLoading] = useState(true);
    const [users, setUsers] = useState([]);
    const [filter, setFilter] = useState('');
    const [page, setPage] = useState(1);
    const [rowsPerPage, setRowsPerPage] = useState(25);
    const [totalPages, setTotalPages] = useState(1);
    useEffect(() => {
        setLoading(true);
        axios.get('/api/users/', {
            params: {
                size: rowsPerPage,
                page: page,
                search: filter,
            }
        })
            .then((response) => {
                setUsers(response.data.data);
                setTotalPages(response.data.meta.last_page);
                setLoading(false);
            })
            .catch(console.log);
    }, [page, rowsPerPage, filter]);

    useEffect(() => {

    }, [filter, ]);

    return (
        <ContentWrapper
            menuName={"User management"}
            menuDescription={"Add, edit, and view the list of your platform users."}
        >
            <UserHeaderList setFilter={setFilter} filter={filter} />
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

            <UserFooterList
                currentPage={page}
                setRowsPerPage={setRowsPerPage}
                setPage={setPage}
                totalPages={totalPages}
                rowsPerPage={rowsPerPage}
                nextPage={page + 1}
                previousPage={page - 1}
            />
        </ContentWrapper>
    );
}
