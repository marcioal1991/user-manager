import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import React, {Fragment} from "react";
import UserListRow from "./UserListRow";
import NoPermission from "../Utils/NoPermission";

function createDataSet(id, name, username, email, mobile, dateOfBirth, lastLoggedIn) {
    return {
        id,
        name,
        username,
        email,
        mobile,
        dateOfBirth,
        lastLoggedIn,
    }
}


export default function UsersTableList({ userList, hasPermission }) {
    const rows = userList.map((user) => {
        return createDataSet(
            user.id,
            user.first_name.concat(' ').concat(user.last_name),
            user.username,
            user.email || '-',
            user.mobile_number,
            user.date_of_birth || '-',
            user.last_logged_in ? (new Date(user.last_logged_in)).toISOString() : '-',
        )
    });

    if (!hasPermission) {
        return (<NoPermission/>);
    }

    return (
        <Fragment>
            <Table size="small" sx={{
                marginLeft: "-16px",
                width: "auto",
                marginRight: "-16px",
            }}>
                <TableHead sx={{ backgroundColor: "rgba(25, 118, 210, 0.1)"}}>
                    <TableRow>
                        <TableCell>Name</TableCell>
                        <TableCell>Username</TableCell>
                        <TableCell>Email</TableCell>
                        <TableCell>Mobile</TableCell>
                        <TableCell>Date of birth</TableCell>
                        <TableCell>Last logged in</TableCell>
                        <TableCell align="right">Actions</TableCell>
                    </TableRow>
                </TableHead>
                <TableBody>
                    {rows.map((row) => (
                        <UserListRow
                            key={row.id}
                            id={row.id}
                            name={row.name}
                            username={row.username}
                            email={row.email}
                            mobile={row.mobile}
                            dateOfBirth={row.dateOfBirth}
                            lastLoggedIn={row.lastLoggedIn}
                        />
                    ))}
                </TableBody>
            </Table>
        </Fragment>
    );
}
