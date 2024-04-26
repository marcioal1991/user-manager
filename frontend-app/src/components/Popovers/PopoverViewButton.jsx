import {Visibility} from "@mui/icons-material";
import Typography from "@mui/material/Typography";
import {IconButton} from "@mui/material";
import React, {useState} from "react";
import UserModalView from "../Modals/UserModalView";

export default function PopoverViewButton({ id }) {
    const [open, setOpen] = useState(false);
    const handleClick = () => {
        setOpen(true);
    };

    const handleClose = () => {
        setOpen(false)
    }
    return (
        <>
            <IconButton onClick={handleClick} sx={{ justifyContent: 'flex-start', width: '100%', borderRadius: 0 }}>
                <Visibility sx={{ fontSize: '16px' }}/>
                <Typography sx={{ marginLeft: '5px', fontSize: '12px' }}>View profile</Typography>
            </IconButton>
            {open && (<UserModalView userId={id}  handleClose={handleClose} open={open}/>)}
        </>
    )
}
