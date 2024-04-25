import {Box, Button, TextField} from "@mui/material";
import {Add} from "@mui/icons-material";
import {useState} from "react";
import UserModalUpsert from "./UserModalUpsert";

export default function UserHeaderList() {
    const [openModal, setOpenModal] = useState(false);
    const handleOpen = () => {
        setOpenModal(true);
    };
    const handleClose = () => {
        setOpenModal(false);
    };

    return (
        <Box sx={{ marginBottom: "16px", display: 'flex', justifyContent: 'space-between'}}>
            <TextField
                size="small"
                id="outlined-size-small"
                label="Search"
                placeholder="Name, email, etc..." />
            <Button
                variant="contained"
                onClick={handleOpen}
                startIcon={<Add />}>New user</Button>

            <UserModalUpsert open={openModal} handleClose={handleClose}/>
        </Box>
    )
}
