import Menu from "../components/Menu";

export default function ForgotPassword({ text }) {
    return (
        <div>
            <Menu></Menu>
            <div>{ text || 'ForgotPassword' }</div>
        </div>);
}
