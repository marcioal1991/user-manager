import {Box, Button, TextField} from "@mui/material";
import {Add} from "@mui/icons-material";
import {useCallback, useState} from "react";
import UserModalUpsert from "../Modals/UserModalUpsert";
import debounce from "lodash/debounce";

export default function UserHeaderList({ setFilter, filter }) {
    const [openModal, setOpenModal] = useState(false);
    const handleOpen = () => {
        setOpenModal(true);
    };
    const handleClose = () => {
        setOpenModal(false);
    };

    const [search, setSearch] = useState(filter);

    const fnDebounce = useCallback(debounce(function (value) {
            setFilter(value)
        }, 1000) , []);

    return (
        <Box sx={{ marginBottom: "16px", display: 'flex', justifyContent: 'space-between'}}>
            <TextField
                size="small"
                id="outlined-size-small"
                label="Search"
                value={search}
                onInput={(event) => {
                    const value = event.target.value || '';
                    setSearch(value)
                    fnDebounce(value)
                }}
                placeholder="Name, email, etc..." />
            <Button
                variant="contained"
                onClick={handleOpen}
                startIcon={<Add />}>New user</Button>

            <UserModalUpsert open={openModal}
                             handleClose={handleClose}
                             alertText="User created successfully. An email has sent to email for verification"/>
        </Box>
    )
}
