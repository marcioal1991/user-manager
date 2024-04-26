import Button from "@mui/material/Button";
import {CircularProgress} from "@mui/material";

export default function SubmitButton({ loading, children, ...props }) {
    return (
        <Button {...props} type="submit" fullWidth variant="contained" sx={{ mt: 3, mb: 2 }}>
            { loading ? (
                <CircularProgress sx={{ color: "#fff" }} size="1.55rem" disableShrink/>
            ) : <span>{ children }</span> }

        </Button>
    )
}
