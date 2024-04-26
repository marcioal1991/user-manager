import {DeleteOutline} from "@mui/icons-material";
import Typography from "@mui/material/Typography";
import {IconButton} from "@mui/material";
import React, {useState} from "react";
import UserModalDelete from "../Modals/UserModalDelete";

export default function PopoverDeleteButton({ id }) {
    const [open, setOpen] = useState(false);
    const handleClick = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false)
    }
    return (
        <>
            <IconButton onClick={handleClick}
                        sx={{ justifyContent: 'flex-start', width: '100%', color: '#ad1d1d', borderRadius: 0 }}>
                <DeleteOutline sx={{ fontSize: '16px' }}/>
                <Typography sx={{ marginLeft: '5px', fontSize: '12px' }}>Delete</Typography>
            </IconButton>
            {open && (<UserModalDelete open={open} handleClose={handleClose} userId={id}/>)}
        </>
    )
}
