import TableCell from "@mui/material/TableCell";
import {Divider, IconButton, Popover, styled} from "@mui/material";
import {MoreVert} from "@mui/icons-material";
import React, {useState} from "react";
import TableRow from "@mui/material/TableRow";
import Container from "@mui/material/Container";
import Box from "@mui/material/Box";
import PopoverEditButton from "../Popovers/PopoverEditButton";
import PopoverDeleteButton from "../Popovers/PopoverDeleteButton";
import PopoverViewButton from "../Popovers/PopoverViewButton";

const StyledTableRow = styled(TableRow)(({ theme }) => ({
    '&:nth-of-type(odd)': {
        backgroundColor: "#f9f9f9",
    },
    '&': {
        height: '40px',
    }
}));

export default function UserListRow({
                                        id,
                                        name,
                                        username,
                                        email,
                                        mobile,
                                        dateOfBirth,
                                        lastLoggedIn,
                                    }) {
    const [anchorEl, setAnchorEl] = useState(null);
    const handleClick = (event) => {
        setAnchorEl(event.currentTarget);
    };

    const handleClose = () => {
        setAnchorEl(null);
    };

    const open = Boolean(anchorEl);
    const popoverId = open ? 'simple-popover' : undefined;

    return (
        <>
            <StyledTableRow key={id}>
                    <TableCell>{name}</TableCell>
                    <TableCell>{username}</TableCell>
                    <TableCell>{email}</TableCell>
                    <TableCell>{mobile}</TableCell>
                    <TableCell>{dateOfBirth}</TableCell>
                    <TableCell>{lastLoggedIn}</TableCell>
                    <TableCell align="right">
                        <IconButton onClick={handleClick}>
                            <MoreVert />
                        </IconButton>
                    </TableCell>
            </StyledTableRow>
            <Popover
                id={popoverId}
                open={open}
                anchorEl={anchorEl}
                onClose={handleClose}
                anchorOrigin={{
                    vertical: 'bottom',
                    horizontal: 'left',
                }}>

                <Container sx={{ border: '1px #f9f9f9 solid', borderRadius: '10px', padding: '0 !important' }}>
                    <Box>
                        <PopoverEditButton id={id} />
                    </Box>
                    <Box>
                        <PopoverViewButton id={id}/>
                    </Box>
                    <Divider/>
                    <Box>
                        <PopoverDeleteButton id={id} />
                    </Box>
                </Container>
            </Popover>
        </>
    )
}
