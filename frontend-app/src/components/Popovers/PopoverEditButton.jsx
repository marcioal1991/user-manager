import {Edit} from "@mui/icons-material";
import Typography from "@mui/material/Typography";
import {IconButton} from "@mui/material";
import React, {useState} from "react";
import UserModalUpsert from "../Modals/UserModalUpsert";
import axios from "axios";

export default function PopoverEditButton({ id }) {
    const [open, setOpen] = useState(false);
    const [editModalData, setEditModalData] = useState(null);
    const handleClick = () => {

        axios.get(`/api/users/${id}`)
            .then((axiosResponse) => {
                const { data } = axiosResponse.data;

                setEditModalData({
                    date_of_birth: data.date_of_birth || '',
                    email: data.email || '',
                    first_name: data.first_name || '',
                    last_name: data.last_name || '',
                    mobile: data.mobile_number || '',
                    username: data.username || '',
                });
                setOpen(true);
        });
    };

    const handleClose = () => {
        setOpen(false)
        setEditModalData(null);
    }
    return (
        <>
            <IconButton onClick={handleClick} sx={{ justifyContent: 'flex-start', width: '100%', borderRadius: 0 }}>
                <Edit sx={{ fontSize: '16px' }}/>
                <Typography sx={{ marginLeft: '5px', fontSize: '12px' }}>Edit</Typography>
            </IconButton>
            {open && (<UserModalUpsert values={{...editModalData}}
                                       handleClose={handleClose}
                                       open={open} userId={id}
                                       alertText="User edited successfully" />)}
        </>
    )
}
