import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import {Fragment} from "react";
import {styled} from "@mui/material";

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


const StyledTableRow = styled(TableRow)(({ theme }) => ({
    '&:nth-of-type(odd)': {
        backgroundColor: "#f9f9f9",
    },
    '&': {
        height: '40px',
    }
}));

function preventDefault(event) {
    event.preventDefault();

}
export default function UsersTableList({ userList }) {
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
                        <StyledTableRow key={row.id}>
                            <TableCell>{row.name}</TableCell>
                            <TableCell>{row.username}</TableCell>
                            <TableCell>{row.email}</TableCell>
                            <TableCell>{row.mobile}</TableCell>
                            <TableCell>{row.dateOfBirth}</TableCell>
                            <TableCell>{row.lastLoggedIn}</TableCell>
                            <TableCell align="right">{`$${row.amount}`}</TableCell>
                        </StyledTableRow>
                    ))}
                </TableBody>
            </Table>
        </Fragment>
    );
}
